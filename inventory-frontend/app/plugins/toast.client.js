import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

export default defineNuxtPlugin((nuxtApp)=>{

  nuxtApp.vueApp.use(Toast,{

    position:"top-right",
    timeout:3000,

    transition:"Vue-Toastification__bounce",

    closeOnClick:true,
    pauseOnHover:true,
    draggable:true,

    hideProgressBar:false,

    icon:true

  })

})