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
        gallery:[]
    },
    mutations: {
        set(state, {type, items}) {
            state[type] = items
        },
    },
    getters: {
        houses(state) {
            return state.houses;
        },
        house:(state) => (id = 14) => {
            var id = parseInt(id);
            return _.find(state.houses,{id:id});
        },
        floors(state) {
            return state.floors;
        },
        floorByNum:(state) => (num = 1) => {
            let floor = _.find(state.floors.floors,{floor:parseInt(num)});
            return floor
        },
        getRealtyInFloor:(state) =>(floor,section)=> {
            let floor1 = parseInt(floor),
             section1 = parseInt(section);
            return  _.filter(state.realtys,{section:section1,floor:floor1})
        },
        realty:(state) => (id) => {
            var id = parseInt(id);
            return _.find(state.realtys,{id:id});
        },

        getRealtysByHouseId:(state, getters) => (houseId = 14) => {
            var houseId = parseInt(houseId);
            return _.filter(state.realtys,{house_id: houseId});
        },
        getRealtyByFloorByHouseId:(state, getters)=>(floorNum,houseId)=>{
            var floorNum = parseInt(floorNum),
                houseId = parseInt(houseId);

            return _.filter(state.realtys,{floor:floorNum, house_id:houseId});
        },
        districtImg(state) {
            return state.district.img;
        }
    },
    actions: {
        getHousesByDistrictId({ commit }, districtId = 15) {
            let endpoint = 'src/api/getHousesByDistrictId'
            Vue.http.get(endpoint, {params: {id: districtId}}).then((response) => {
                let data = response.data.response;
                let district = {
                    id: data.district_id,
                    img: data.path
                }
                commit('set',{type:'district', items:district});
                commit('set',{type:'houses', items:data.houses});
            },(err) => { throw err });
        },
        getFloorsByHouseId({ commit }, house_id = 14) {
            let endpoint = 'src/api/getFloorsByHouseId'
            return new Promise((resolve, reject) => {
                Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                    let data = response.data.response;
                    _.each(data.floors,(floor)=> {
                        _.each(floor.polygon,(el)=> {
                            let realty = this.getters.realty(el.realty);
                            el.color = (realty.status == 'free' && !realty.reserv)?'rgba(0,0,0,0)':'rgba(198,195,220,.8)';
                            el.reserv = (realty.status == 'free' && !realty.reserv);
                        })
                    })
                    commit('set',{type:'floors', items:data});
                    resolve(response);
                },(err) => { reject(error); });
            });
            // Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
            //     let data = response.data.response;
            //     _.each(data.floors,(floor)=> {
            //         _.each(floor.polygon,(el)=> {
            //             let realty = this.getters.realty(el.realty);

            //             el.color = (realty.status == 'free' && !realty.reserv)?'rgba(0,0,0,0)':'rgba(198,195,220,.8)';
            //             el.reserv = (realty.status == 'free' && !realty.reserv);
            //         })
            //     })
            //     commit('set',{type:'floors', items:data});
            // },(err) => { throw err });
        },
        getRealtysByHouseId({ commit }, house_id = 14){
            let endpoint = 'src/api/getRealtysByHouseId'
            return new Promise((resolve, reject) => {
                Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                    let data = response.data.response.realty
                    commit('set',{type:'realtys', items:data});
                    resolve(response);
                },(err) => {reject(error); });
            });
        }
    },
    plugins: [createPersistedState()]
});

export default store