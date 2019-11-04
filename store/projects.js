export const state = () => ({
    list: [],
    project: {
        id: '',
        bloc: ''
    }
})


export const mutations = {
    add(state, project) {
        state.list.push(project)
    },
    emptyList(state) {
        state.list = []
    },
    setProject(state, project) {
        state.project = project
    }
}

// export const getters = {
//     list: state => {
//         return state.list
//     }
// }