<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="row">
            <span class="col-4"> <CIcon icon="cil-drop"/> Create question</span>
            <div class="col-4 offset-4 require-input">
              <div class="row">
                <div class="label col-3 offset-6 text"><span>Required ?</span></div>
                <div class="col-3 text-end">
                  <label class="switch">
                    <input type="checkbox" v-model="required">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </CCardHeader>
        <CCardBody>
          <CRow>
            <CForm action="#" id="formCreate">
              <div class="row">
                <div class="col-8 mb-3">
                  <InputWithLabel :placeholderTitle="placeholderTitle" requried :title="title"
                  ></InputWithLabel>
                </div>
                <div class="col-4 mb-3">
                  <Select :title="select" :options="options" @select-changed="changeSelect"></Select>
                </div>
              </div>
              <div class="row content">
                <div class="col-12">
                  <FillTheBlank v-if="view==='1'" v-model="question" @childToParent="getQuestion"></FillTheBlank>
                  <OneChoice v-if="view==='2'"></OneChoice>
                  <MultipleChoice v-if="view==='3'"></MultipleChoice>
                  <TrueFalse v-if="view==='4'"></TrueFalse>
                </div>
              </div>
              <div class="submit">
                <button type="submit" class="btn btn-success text-white float-end" v-if="!isNaN(view)" @click="save">
                  Save
                </button>
              </div>
            </CForm>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
  <Teleport to="body">
    <div v-if="isOpen" class="modal">
      <div class="button-close col-12">
        <button @click="isOpen = false" class="float-end btn-close"></button>
      </div>
     <div class="model-content">
       <b>Please correct the following error(s):</b>
       <ul>
         <li v-for="[error, index] in errors" :key="index" class="text-red">{{ error }}</li>
       </ul>
     </div>
    </div>
  </Teleport>
</template>
<script>
import Select from '../components/Select'
import InputWithLabel from "@/views/components/InputWithLabel";
import FillTheBlank from "@/views/questions/components/FillTheBlank";
import MultipleChoice from "@/views/questions/components/MultipleChoice";
import OneChoice from "@/views/questions/components/OneChoice";
import TrueFalse from "@/views/questions/components/TrueFalse";
import {APISettings} from '@/config/config';
import router from '@/router';

export default {
  name: 'Create',
  components: {FillTheBlank, Select, InputWithLabel, MultipleChoice, OneChoice, TrueFalse},
  created() {
    this.fetchData();
  },
  data() {
    return {
      select: 'questionType',
      title: 'title',
      question: '',
      placeholderTitle: 'title',
      options: [],
      view: NaN,
      required: false,
      errors: [],
      isOpen: false
    }
  },
  methods: {
    changeSelect(data) {
      this.view = data;
    },
    getQuestion(value) {
      this.question = value
    },
    async save(e) {
      e.preventDefault();
      let myForm = document.getElementById('formCreate');
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
      data.question = this.question;
      data.required = this.required;

      fetch('http://localhost/api' + '/exams/'+ this.$route.params.id +'/questions/store', {
        method: 'POST',
        headers: APISettings.headers,
        body: JSON.stringify(data)
      })
        .then(function (response) {
          return response.json()
        })
        .then((data) => {
          if (data.errors) {
            this.errors = [];
            this.errors = Object.keys(data.errors).map((key) => data.errors[key]);
            this.isOpen = true;
          } else {
            router.push({
              name: 'Questions',
              params: {
                id: data.examId
              }
            }).catch(err => {
              console.log(err)
            });
          }
        })
        .catch(e => {
          console.log(e)
        })
    },
    fetchData() {
      let fetchData = fetch('http://localhost/api' + '/question/types', {
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
        for (let i = 0; i < data.type.length; i++) {
          data.type[i].index = data.type[i].id;
          data.type[i].value = data.type[i].name
        }
        this.options = data.type;
      })
    }
  },
}
</script>
<style scoped>
.text-red {
  color: red;
}
.modal {
  display: block;
  position: fixed;
  z-index: 999;
  top: 30%;
  left: 50% !important;
  width: 500px;
  margin-left: -150px;
  background-color: white;
  border-radius: 8px;
  padding:15px;
  box-shadow: 0 4px 16px #00000026;
  height:auto;
}
.button-close {
  height:30px;
  border-bottom: 1px solid #00000026;
}
.model-content {
  padding:10px;
}
</style>
