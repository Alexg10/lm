<template>
    <div>
        <div class="loading" v-if="$store.state.projects.loading">Loading ...</div>
        <ProjectsList v-else/>
    </div>
</template>

<script>
    import ProjectsList from '~/components/projects/list';

    export default {
        transition: 'listFade',
        components:{
            ProjectsList
        },
        async fetch({store, params}){
            await store.dispatch('projects/getProjects')
        }
    }
</script>