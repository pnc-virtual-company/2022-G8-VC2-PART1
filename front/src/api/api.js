import axios from "axios";

const axiosApi = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer ' +  localStorage.getItem('token')
  },
});

axiosApi.interceptors.request.use(function (config) {
  const token = localStorage.getItem("token");
  config.headers.Authorization = token ? `Bearer ${token}` : "";
  return config;
});

export default axiosApi;

