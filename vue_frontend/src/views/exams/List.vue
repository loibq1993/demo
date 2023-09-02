<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CIcon icon="cil-drop" />
          Exam list
        </CCardHeader>
        <CCardBody>
          <table class="table table-striped mentors">
            <thead class="thead">
            <tr>
              <th scope="col" style="width: 5%">#</th>
              <th scope="col">Title</th>
              <th scope="col" style="width: 15%">Start date</th>
              <th scope="col" style="width: 15%">End date</th>
              <th scope="col" style="width: 10%">Minium score</th>
              <th scope="col" style="width: 15%">
                <a v-bind:href="href.create" class="btn btn-primary">
                  <i class="fa fa-plus"></i>
                </a>
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(exam, index) in exams" :key="index">
              <td>{{index++}}</td>
              <td>{{exam.title}}</td>
              <td>{{format_date(exam.start_date)}}</td>
              <td>{{format_date(exam.end_date)}}</td>
              <td>{{exam.minimum_score}}</td>
              <td>
                <a v-bind:href="href.edit" class="btn btn-warning" style="margin-right: 5px;">
                  <i class="fa fa-pencil"></i>
                </a>
                <a v-bind:href="href.delete" class="btn btn-danger" style="margin-right: 5px;">
                  <i class="fa fa-trash"></i>
                </a>
                <a v-bind:href="href.preview+'/'+exam.id" class="btn btn-danger">
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
        create: '/exams/create',
        edit: '/exams/edit',
        delete: '/exams/delete',
        preview: '/exams/preview'
      },
      exams: [],
      types: []
    }
  },
  created() {
    this.fetchExams();
  },
  methods: {
    fetchExams() {
      let fetchData = fetch('http://54.179.55.45/api' + '/exams', {
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
        this.exams = data.exams
      })
    },
    format_date(value){
      if (value) {
        return moment(String(value)).format('YYYY-MM-DD HH:mm:ss')
      }
    },
  }

}
</script>

<style scoped>

</style>
