<template>
  <div>
    <Header></Header>
    <Cover />
    <nuxt />
    <CursorBlock />
  </div>
</template>

<script>
  import Header from '../components/Header'
  import Cover from '../components/Cover'
  import CursorBlock from '../components/Cursor'


  export default {
    components: {
      Header,
      Cover,
      CursorBlock
    },
    methods: {
      moveCursor(e){
        console.log('cursor');
        // const cursor = document.querySelector('.cursor');
        // cursor.setAttribute("style", "top: "+(e.pageY - 20)+"px; left: "+(e.pageX - 20)+"px");






      }
    },
    mounted(){

    }
  }
</script>
<style lang="scss">
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  // cursor: none;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}
#cursor{
  position: fixed;
  left: 50%;
  top: 50%;
  width: 45px;
  height: 45px;
  border: 1px solid #B4B3B1;
  border-radius: 100px;
  transform: translate(-20px, -20px); 
  /* transition-duration: 0.2s;
  transition-timing-function: ease-in-out; */
  /* transition: top 200ms ease-in-out, left 200ms ease-in-out; */
  pointer-events: none;
  transition: width 0.4s ease, height 0.4s ease;
  z-index: 9999;
  &.hover{
    width: 15px;
    height: 15px;
    transform: translate(-8px, -5px);
    transition: width 0.5s ease, height 0.5s ease;
  }
}
</style>
