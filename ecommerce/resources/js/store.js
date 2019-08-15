import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        welcome: null,
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        products: []
    },
    getters: {
        welcome(state) {
            return 'Welcome!!'
        },
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        products(state) {
            return state.products;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateProducts(state, payload) {
            state.products = payload;
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getProducts(context) {
            axios.get('/api/v1/products')
                .then((response) => {
                    context.commit('updateProducts', response.data.data);
                })
        }
    }
};
