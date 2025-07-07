import axios from "axios";

const API_BASE_URL = "http://localhost:3000/api";

const ProductService = {
    getProductsByIds: async (productIds) => {
        if (!Array.isArray(productIds) || productIds.length === 0) return [];
        try {
            const response = await axios.get(`${API_BASE_URL}/products`, {
                // Concatenar /products
                params: { ids: productIds.join(",") },
            });
            return response.data;
        } catch (error) {
            const err = error.response?.data || {
                message: "Erro ao buscar produtos por IDs",
            };
            console.error("Erro em ProductService.getProductsByIds:", error);
            throw new Error(err.message);
        }
    },

    getProductById: async (productId) => {
        try {
            const response = await axios.get(
                `${API_BASE_URL}/products/${productId}`
            ); // Concatenar /products
            return response.data;
        } catch (error) {
            const err = error.response?.data || {
                message: `Erro ao buscar produto ${productId}`,
            };
            console.error("Erro em ProductService.getProductById:", error);
            throw new Error(err.message);
        }
    },
};

export default ProductService;
