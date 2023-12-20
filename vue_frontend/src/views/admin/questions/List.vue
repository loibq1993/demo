<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CIcon icon="cil-drop" />
          Question list
        </CCardHeader>
        <CCardBody>
          <table class="table table-striped mentors">
            <thead class="thead">
            <tr>
              <th scope="col" style="width: 5%">#</th>
              <th scope="col" style="width: 30%">Title</th>
              <th scope="col" style="width: 35%">Type</th>
              <th scope="col" style="width: 15%">Created date</th>
              <th scope="col" style="width: 15%">
                <a v-bind:href="href.create" class="btn btn-primary">
                  <i class="fa fa-plus"></i>
                </a>
              </th>
            </tr>
            </thead>
            <tbody>
              <tr v-for="(question, index) in questions" :key="index">
                <td>{{index++}}</td>
                <td>{{question.title}}</td>
                <td>{{displayType(question.type)}}</td>
                <td>{{format_date(question.created_at)}}</td>
                <td>
                  <a v-bind:href="href.edit" class="btn btn-warning" style="margin-right: 5px;">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a v-bind:href="href.delete" class="btn btn-danger" style="margin-right: 5px;">
                    <i class="fa fa-trash"></i>
                  </a>
                  <a v-bind:href="href.preview+'/'+question.id" class="btn btn-danger">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import {APISettings} from "@/config/config";
import moment from 'moment';

export default {
  name: 'List',
  components: {},
  setup() {},
  data() {
    return {
      href: {
        create: '/admin/exams/'+ this.$route.params.id +'/questions/create',
        edit: '/admin/exams/'+ this.$route.params.id +'/questions/edit',
        delete: '/admin/exams/'+ this.$route.params.id +'/questions/delete',
        preview: '/admin/exams/'+ this.$route.params.id +'/question/preview'
      },
      questions: [],
      types: []
    }
  },
  created() {
    this.fetchQuestions();
    this.fetchType();
  },
  methods :  {
    fetchQuestions() {
      let fetchData = fetch('http://54.179.55.45/api/' + 'exams/' + this.$route.params.id + '/questions', {
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
        this.questions = data.questions
      })
    },
    fetchType() {
      let fetchData = fetch('http://54.179.55.45/api' + '/question/types', {
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
        this.types = data.type
      })
    },
    format_date(value){
      if (value) {
        return moment(String(value)).format('YYYY-MM-DD')
      }
    },
    displayType(value) {
      for (let i = 0; i < this.types.length; i++) {
        if (value === this.types[i].id) {
          return this.types[i].name
        }
      }
    }
  },

}
</script>
