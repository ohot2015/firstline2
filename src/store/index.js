import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'
// для сохранения state в localstorage
import createPersistedState from 'vuex-persistedstate'

import _ from 'underscore'
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        district: {
            id:0,
            img:''
        },
        houses:[],
        realtys: [],
        floors:[],
    },
    mutations: {
        set(state, {type, items}) {
            state[type] = items
        }
    },
    getters: {
        houses(state) {
            return state.houses;
        },
        house:(state) => (id) => {
            var id = parseInt(id);
            return _.find(state.houses,{id:id});
        },
        floors(state) {
            return state.floors;
        },
        realty:(state) => (id) => {
            var id = parseInt(id);
            return _.find(state.realtys.realty,{id:id});
        },
        getRealtyByFloorByHouseId:(state, getters)=>(floorNum,houseId)=>{
            var floorNum = parseInt(floorNum),
                houseId = parseInt(houseId);
            return _.filter(state.realtys.realty,{floor:floorNum, house_id:houseId});
        },
        districtImg(state) {
            return state.district.img;
        }
    },
    actions: {
        getHousesByDistrictId({ commit }, districtId = 14) {
            let endpoint = 'src/api/getHousesByDistrictId.php'
            Vue.http.get(endpoint, {params: {district_id: districtId}}).then((response) => {
                let data = response.data.response;
                let district = {
                    id: data.district_id,
                    img: data.path
                }
                commit('set',{type:'district', items:district});
                commit('set',{type:'houses', items:data.houses});
            },(err) => { throw err });
        },
        getFloorsByHouseId({ commit }, house_id = 15) {
            let endpoint = 'src/api/getFloorsByHouseId.php'
            Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                let data = response.data.response;
                commit('set',{type:'floors', items:data});
            },(err) => { throw err });
        },
        getRealtysByHouseId({ commit }, house_id = 15){
            let endpoint = 'src/api/getRealtysByHouseId.php'

            Vue.http.get(endpoint, {params: {house_id: house_id}}).then((response) => {
                let data = response.data.response;
                commit('set',{type:'realtys', items:data});
            },(err) => { throw err });
        }
    },
    plugins: [createPersistedState()]
});

export default store