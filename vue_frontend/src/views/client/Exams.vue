<template>
  <div class="bg-light min-vh-100 d-flex flex-row">
    <CContainer>
      <CRow class="justify-content-center">
        <table class="table table-striped mentors">
          <thead class="thead">
          <tr>
            <th scope="col" style="width: 5%">#</th>
            <th scope="col" style="width: 25%">Title</th>
            <th scope="col" style="width: 30%">Description</th>
            <th scope="col" style="width: 10%">Start date</th>
            <th scope="col" style="width: 10%">End date</th>
            <th scope="col" style="width: 10%">Time</th>
            <th scope="col" style="width: 10%">Pass score</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(exam, index) in exams" :key="index" @click="linkRedirect(exam.id)">
            <td>{{ index+1 }}</td>
            <td>{{ exam.title }}</td>
            <td>{{ exam.description }}</td>
            <td>{{ format_date(exam.start_date) }}</td>
            <td>{{ format_date(exam.end_date) }}</td>
            <td>{{getTime(exam.start_time, exam.end_time)}}</td>
            <td>{{ exam.minimum_score }}%</td>
          </tr>
          </tbody>
        </table>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
import {APISettings} from "@/config/config";
import moment from "moment/moment";
import router from '@/router';

export default {
  name: 'Exams',
  data() {
    return {
      exams: [],
      href: window.location
    }
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      let fetchData = fetch('http://localhost/api' + '/test/exams', {
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
        this.exams = data.exams;
      })
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format('YYYY-MM-DD')
      }
    },
    getTime(start_time, end_time) {
      start_time = moment(start_time, 'HH:mm:ss A')
      end_time = moment(end_time, 'HH:mm:ss A')
      let diff = end_time.diff(start_time);
      return moment.utc(diff).format("HH:mm:ss")
    },
    linkRedirect(id) {
      return router.push({path: '/exams/'+id})
    }
  }
}
</script>
