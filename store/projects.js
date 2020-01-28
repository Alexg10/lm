import axios from 'axios'

export const state = () => ({
    loading: true,
    list: [],
    current: false,
    cover: false,
    fromProject:''
})

export const actions = {
    async getProjects ({ commit }, currentProjectSlug) {
        const { data } = await axios.get('http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets');
        commit('hydrate', data);
        commit('setProject', currentProjectSlug);
    }
}

export const mutations = {
    hydrate(state, data){
        data.forEach(function (element) {
            let project = new Object;

            project.id = element.id;
            project.type = element.acf.project_type;
            project.name = element.title.rendered;
            project.slug = element.slug;
            project.cover = element.acf.header_picture.url;
            project.acf = element.acf;
            project.title = element.title.rendered;
            project.description = element.acf.project_description;
            project.link = element.acf.project_link;
            project.HeaderImg = element.acf.header_picture.sizes.header_picture;
            project.projectBlocName = element.acf.blocs;
            project.footerLink = element.acf.footer_link.url;
            project.footerLinkTitle = element.acf.footer_link.title;

            state.list.push(project);
        });
        state.loading = false;
    },
    setProject(state, slug) {
        const project = state.list.find(project => project.slug == slug);
        state.current = project
    },
    setCover(state, slug) {
        const project = state.list.find(project => project.slug == slug);
        state.cover = project
    },
    emptyCover(state) {
      state.cover = false
    }
}