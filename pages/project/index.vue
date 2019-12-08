<template>
    <div>
        <div class="loading" v-if="$store.state.projects.loading">Loading ...</div>
        <ProjectsList v-else/>
    </div>
</template>

<script>
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets'
    import ProjectsList from '../../components/projects/list';

    export default {
        data() {
            return {
                apiUrl
            }
        },
        components:{
            ProjectsList
        },
        fetch({store, params}){
            return axios.get(`${apiUrl}`)
            .then(res => {
                store.commit('projects/hydrate', res);
            })
        }
    }
</script>