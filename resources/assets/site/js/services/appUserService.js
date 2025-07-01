import axios from 'axios';

const API_BASE_URL = 'http://localhost:3000/api/app-user';

const AppUserService = {
  login: async (email, password) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/login`, {
        email,
        password,
      });
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro na requisição de login' };
    }
  },

  register: async (name, email, password) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/register`, {
        name,
        email,
        password,
      });
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro ao registrar usuário' };
    }
  },

  getCurrentUser: async (token) => {
    try {
      const response = await axios.get(`${API_BASE_URL}/me`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro ao obter usuário logado' };
    }
  },
};

export default AppUserService;
