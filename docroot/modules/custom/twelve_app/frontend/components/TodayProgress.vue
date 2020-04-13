<template>
 <div>
 <main-filter
         :options="excercisesOptions"
         :current_nid="current_nid"
         :completion_url="completion_url"
         v-on:data-update="sendData"
 ></main-filter>
 <notifications group="twelve_app"></notifications>
 </div>
</template>

<script>

    import Spinner from '../components/Spinner.vue'
    import MainFilter from '../components/Filter.vue'

    const axios = require('axios');

    export default {
        props: ['excercises', 'current_nid', 'completion_url'],
        data() {
            return {
                checkedExcercises: [],
                userData: {
                    'name': '',
                },
                isStepNextDisabled: true
            };
        },
        components: {
            Spinner,
            MainFilter,
        },
        mounted() {

        },
        methods: {

            sendData: function (checked) {
                let result_url = window.location.origin + '/node';
                let request_type = 'post';

                let data = {
                    'type': '12_bursts_result',
                    'title': {
                        'value': localStorage.twelveUserName
                    },
                    'field_when': {
                        'value': this.$props.current_nid,
                    },
                    'field_finished_items': checked
                };

                let result_key = 'result_node_id_for_' + this.$props.current_nid;
                let result_nid = localStorage.getItem(result_key);
                if (result_nid) {
                    result_url += '/' + result_nid;
                    request_type = 'patch';
                }

                axios({url: '/session/token'}).then(data => {
                  let token = data.data;
                }).catch(function (error) {

                });

                axios({
                    method: request_type,
                    url: result_url,
                    data: data,
                    headers: {

                    },
                    auth: {
                        username: '12bursts_consumer',
                        password: 'e+bMS3E)}qv(rAMa'
                    }
                }).
                  then(function (response) {
                    let result_key = 'result_node_id_for_' + this.$props.current_nid;
                    let value = response.data.nid[0].value;
                    localStorage.setItem(result_key, value);
                }.bind(this)).catch(function (error) {
                    //@TODO Add error handler
                });

            }

        },
        computed: {
            excercisesOptions: function () {

                var options = {};

                for (var i in this.excercises) {
                    var item = this.excercises[i];
                    options[i] = {
                        'label': item.label,
                        'description': item.description,
                        'timer': item.timer,
                        'gif_path': item.gif,
                        'id': i,
                    };
                }

                return options;
            }
        }
    }
</script>
