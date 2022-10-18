<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CIcon icon="cil-drop"/>
          Create question
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
                <button type="submit" class="btn btn-success text-white float-end" v-if="!isNaN(view)" @click="save">Save</button>
              </div>
            </CForm>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
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
      errors: [],
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

      fetch('http://localhost/api' + '/question/store', {
        method: 'POST',
        headers: APISettings.headers,
        body: JSON.stringify(data)
      })
        .then(function (response) {
          if (response.status !== 200) {
            throw response.status;
          } else {
            router.push({name: 'Questions'}).catch(err => { console.log(err) });
          }
        })
        .then(function () {
          // this.$router.push('/questions')
        })
        .catch(console.error)
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
        this.options=data.type;
      })
    }
  },
}
</script>
