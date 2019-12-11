export const state = () => ({
    loading: true,
    list: [],
    current: false,
    currentProjectData: [],
    nextProject: []
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
        let currentProject = new Object;
        currentProject.slug = project.data[0].slug;
        currentProject.acf = project.data[0].acf;
        currentProject.title = project.data[0].title.rendered;
        currentProject.description = project.data[0].acf.project_description;
        currentProject.HeaderImg = project.data[0].acf.header_picture.sizes.header_picture;
        currentProject.projectBlocName = project.data[0].acf.blocs;
        currentProject.footerLink = project.data[0].acf.footer_link.url;
        currentProject.footerLinkTitle = project.data[0].acf.footer_link.title;

        state.currentProjectData.push(currentProject);
        state.list.push(project)
    },
    emptyList(state) {
        state.list = []
    },
    setProject(state, id) {
        const project = state.list.find(project => project.id == id);
        console.log(id);
        state.current = project;
        
    }
}