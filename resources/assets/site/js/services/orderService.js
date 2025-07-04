import axios from 'axios';

const API_BASE_URL = 'http://localhost:3000/api/orders';

const OrderService = {
  createOrder: async (items, isPix = false, token) => {
    try {
      const response = await axios.post(
        API_BASE_URL,
        { items, isPix },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro ao criar pedido' };
    }
  },

  getOrders: async (token, filters = {}) => {
    try {
      const response = await axios.get(API_BASE_URL, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        params: filters,
      });
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro ao buscar pedidos' };
    }
  },

  updateOrderStatus: async (id, statusPayload, token) => {
    try {
      const response = await axios.put(
        `${API_BASE_URL}/${id}/status`,
        statusPayload,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: 'Erro ao atualizar status do pedido' };
    }
  },
};

export default OrderService;
