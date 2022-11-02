<template>
  <div class="bg-light min-vh-100 d-flex flex-row mb-5">
    <CContainer>
      <CForm action="#" id="formExam">
        <CRow class="justify-content-center">
          <div class="header-content w-50 m-auto mb-5">
            <div class="border p-4">
              <div class="title row">
                <label class="col-3 mb-2">Title: </label>
                <span class="col-9">{{ exam.title }}</span>
              </div>
              <div class="description row">
                <label class="col-3 mb-2">Description: </label>
                <span class="col-9">{{ exam.description }}</span>
              </div>
              <div class="start_date row">
                <label class="col-3 mb-2">Start date: </label>
                <span class="col-9">{{ format_date(exam.start_date) }}</span>
              </div>
              <div class="end_date row">
                <label class="col-3 mb-2">End date: </label>
                <span class="col-9">{{ format_date(exam.end_date) }}</span>
              </div>
              <div class="time row">
                <label class="col-3 mb-2">Time: </label>
                <span class="col-9" id="countdown"></span>
              </div>
            </div>
          </div>
          <div class="exam-content border p-4">
            <div v-for="(exam_question, index) in exam_questions" :key="index">
              <FillTheBlank v-if="exam_question.questions[0].type===1" :question="exam_question.questions[0]"
                            :index="index+1"></FillTheBlank>
            </div>
          </div>
        </CRow>
        <div class="submit mt-3 row">
          <button type="submit" id="form-submit" class="btn btn-success m-auto text-white w-auto" @click="save">Save
          </button>
        </div>
      </CForm>
    </CContainer>
  </div>
</template>

<script>
import {APISettings} from "@/config/config";
import moment from "moment/moment";
import FillTheBlank from "@/views/client/question-components/FillTheBlank";
import router from "@/router";

export default {
  name: 'Exam',
  components: {FillTheBlank},
  data() {
    return {
      view: NaN,
      exam_questions: '',
      answers: '',
      exam: [],
      href: window.location,
      countdown: '',
      timer: ''
    }
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      let fetchData = fetch('http://localhost/api' + '/test/exams/' + this.$route.params.id, {
        method: 'GET',
        headers: APISettings.headers
      })
        .then(function (response) {
          if (response.status !== 200) {
            throw response.status;
          } else {
            return response.json();
          }
        });
      fetchData.then(data => {
        if (!data.exam) {
          router.push({
            name: "Page404"
          })
        }
        this.exam = data.exam;
        this.exam_questions = data.exam.exam_questions
        let time = this.exam.count_down;
        let arr = time.split(':');
        this.timer = (arr[0] * 3600 + arr[1] * 60 + (+arr[2])) * 1000;
        this.countDown();
      })
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format('YYYY-MM-DD')
      }
    },
    countDown() {
      var currentTime = new Date().getTime();
      var countDownDate = currentTime + this.timer;
      var x = setInterval(function () {
        //get now
        let now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = new Date(countDownDate - now).getTime();

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("countdown").innerHTML = hours + "h "
          + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("form-submit").click();
        }
      }, 1000);
    },
    async save(e) {
      e.preventDefault();

      let myForm = document.getElementById('formExam');
      let formData = new FormData(myForm);

      //the way to handle data
      var sameKey = [];
      let data = {};
      for (let [key, val] of formData.entries()) {
        if (key !== sameKey[key]) {
          sameKey[key] = key;
          data[key] = [];
          data[key].push(val)
        } else {
          data[key].push(val)
        }
      }
      data.exam_id = this.exam.id
      data.time = document.getElementById('countdown').innerHTML

      fetch('http://localhost/api' + '/test/exams/' + this.$route.params.id, {
        method: 'POST',
        headers: APISettings.headers,
        body: JSON.stringify(data)
      })
        .then(function (response) {
          return response.json();
        })
        .then((data) => {
          console.log(data);
        })
    }
  }
}
</script>
<style scoped>
.border {
  border: 1px solid gray;
  border-radius: 5px;
  box-shadow: 2px 2px #888888;
  background-color: #fff;
}

.submit .btn-success {
  right: 0;
}
</style>
