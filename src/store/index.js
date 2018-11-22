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
        gallery:[],
        stream:[],
        absPath: location.origin,
        fasads:{},
        selectedButton:{
            1:false,
            2:false,
            3:false,
            4:false
        },
        districtId: 18,
        houseId: 18,
    },
    mutations: {
        set(state, {type, items}) {
            state[type] = items
        },
    },
    getters: {
        preloader(state){
            return state.preloader;
        },
        findAll: (state) => (entity) => {
            return state[entity]
        },
        findBy: (state) => (entity, query = {}) => {
            return _.filter(state[entity], query);
        },
        findByOne: (state) => (entity, query = {}) => {
            return _.find(state[entity], query);
        },
        houses(state) {
            return state.houses;
        },
        house: (state, actions) => (houseId = 0) => {
            houseId = houseId ? houseId : state.houseId;
            houseId = parseInt(houseId);
            return _.find(state.houses, {id: houseId});
        },

        floors(state) {
            return state.floors;
        },
        floorSectionByNum: (state) => (floorNum = 1, sectionNum = 1) => {
            let floor = [];
            if (state.floors.floors[parseInt(floorNum )]) {
                floor = state.floors.floors[parseInt(floorNum )][parseInt(sectionNum)]
            }
            return floor;
        },
        getRealtyInFloor: (state) => (floor, section) => {
            let floor1 = parseInt(floor),
                section1 = parseInt(section);
            return _.filter(state.realtys, {section: section1, floor: floor1});
        },
        realty: (state) => (id) => {
            var id = parseInt(id);
            return _.find(state.realtys, {id: id});
        },
        getRealtysByHouseId: (state, getters) => (houseId = 0) => {
            houseId = houseId ? houseId : state.houseId;
            houseId = parseInt(houseId);
            return _.filter(state.realtys, {house_id: houseId});
        },
        getRealtyByFloorByHouseId: (state, getters) => (floorNum, sectionNum, houseId) => {
            var floorNum = parseInt(floorNum),
                houseId = parseInt(houseId),
                sectionNum = parseInt(sectionNum);
            return _.filter(state.realtys, {floor: floorNum, section: sectionNum, house_id: houseId});
        },
        districtImg(state) {
            return state.district.img;
        },
        fasadFilterRoom(state) {

            let selectedButton = state.selectedButton;
            // if (!selectedButton[1]
            //     && !selectedButton[2]
            //     && !selectedButton[3]
            //     && !selectedButton[4]
            // ) {
            //     selectedButton = {1:1,2:1,3:1,4:1}
            // }

            let realtys = _.filter(state.realtys, (item) => {
                return selectedButton[item.rooms] && item.status == 'free' && !item.reserv;
            });
            let fasad1 = state.fasads.fasads;

            for (let j in fasad1) {
                for (let i in fasad1[j]) {
                    let fasad = fasad1[j][i];
                    if ( typeof fasad === 'object' && fasad != null) {
                        fasad.fill = 'rgba(255,255,255,0)';
                        if (_.filter(realtys, {floor: fasad.floor, section: fasad.pod}).length) {
                            fasad.fill = 'rgba(255,255,255,.5)';
                        }
                    }
                }
            }
            return fasad1;

        }
    },
    actions: {
        getHousesByDistrictId({ commit }, districtId = 0) {
            let endpoint = this.getters.findAll('absPath') + '/src/api/getHousesByDistrictId'

            districtId = districtId ? districtId : this.state.districtId;

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
        getFloorsByHouseId({ commit }, house_id = 0) {
            let endpoint = this.getters.findAll('absPath')+'/src/api/getFloorsByHouseId';

            house_id = house_id ? house_id : this.state.houseId;

            return new Promise((resolve, reject) => {
                Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                    let data = response.data.response;
                    _.each(data.floors,(floor)=> {
                        _.each(floor,(pod)=> {
                            _.each(pod.polygon, (el) => {
                                let realty = this.getters.realty(el.realty);
                                if (realty) {
                                    el.color = (realty.status == 'free' && !realty.reserv) ? 'rgba(0,0,0,0)' : 'rgba(198,195,220,.8)';
                                    el.reserv = (realty.status == 'free' && !realty.reserv);
                                }
                            })
                        })
                    })
                    commit('set',{type:'floors', items:data});
                    resolve(response);
                },(err) => { reject(error); });
            });
        },
        getFasadByHouseId({ commit }, house_id = 0) {
            let endpoint = this.getters.findAll('absPath')+'/src/api/getFasadByHouseId';

            house_id = house_id ? house_id : this.state.houseId;

            return new Promise((resolve, reject) => {
                Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                    let data = response.data.response;
                    // for(let fasad in data.fasads ) {
                    //     let img = new Image();
                    //     img.src = 'http://' + data.fasads[fasad].url;
                    //     img.onload = function() {
                    //         data.fasads[fasad]['imgW'] = this.width;
                    //         data.fasads[fasad]['imgH'] = this.height;
                    //         console.log(2)
                    //     };
                    // }

                    commit('set',{type:'fasads', items:data});
                    resolve(response);
                },(err) => { reject(error); });
            });
        },
        getRealtysByHouseId({ commit }, house_id = 0){
            let endpoint = this.getters.findAll('absPath')+ '/src/api/getRealtysByHouseId';
            house_id = house_id ? house_id : this.state.houseId;
            return new Promise((resolve, reject) => {
                Vue.http.get(endpoint, {params: {id: house_id}}).then((response) => {
                    let data = response.data.response.realty
                    commit('set',{type:'realtys', items:data});
                    resolve(response);
                },(err) => {reject(error); });
            });
        },
        getGallery({commit}, year = 2018) {
            let endpoint = this.getters.findAll('absPath') + '/src/api/gallery';
            Vue.http.get(endpoint).then((response)=>{
                let img = [];
                _.each(response.data.images[2018], (el,monthName) => {
                    let month = {
                        title: monthName,
                        imgPrev: el.main? el.main: el[0],
                        images: []
                    }
                    _.each(el,(path) => {
                        let obj = {
                            src: path
                        }
                        month.images.push(obj);
                    })
                    img.push(month)
                })
                commit('set',{type:'gallery',items:img});
                let stream = [];
                _.each(response.data.stream,(path) => {
                    let obj = {
                        src: path
                    }
                    stream.push(obj);
                })
                commit('set',{type:'stream',items:stream});
            },(err) => {throw err})
        }
    },
    plugins: [createPersistedState()],

});

export default store