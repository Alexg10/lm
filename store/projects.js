export const state = () => ({
    loading: true,
    list: [],
    current: false
})


export const mutations = {
    hydrate(state, data){
        data.data.forEach(function (element) {
            let project = new Object;
            project.id = element.id;
            project.name = element.title.rendered;
            project.slug = element.slug;
            project.cover = element.acf.header_picture.url;
            state.list.push(project);
        });
        state.loading = false;
    },
    add(state, project) {
        state.list.push(project)
    },
    emptyList(state) {
        state.list = []
    },
    setProject(state, id) {
        const project = state.list.find(project => project.id == id);
        state.current = project
    }
}