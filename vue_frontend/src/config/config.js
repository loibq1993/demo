export const APISettings = {
  token: '',
  headers: new Headers({
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }),
  baseURL: process.env.VUE_APP_BASE_URL,
}
