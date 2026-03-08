<script setup>

useHead({
  title: "Login"
})

import { ref, onMounted } from "vue"
import { useToast } from "vue-toastification"

const toast = useToast()

const username = ref("")
const password = ref("")
const remember = ref(true)
const loading = ref(false)
const showPassword = ref(false)
const now = ref("")

const { $api } = useNuxtApp()

const updateClock = () => {
  const d = new Date()

  const date = d.toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "long",
    year: "numeric"
  })

  const time = d.toLocaleTimeString("id-ID")

  now.value = `${date} ${time}`
}

onMounted(()=>{
  updateClock()
  setInterval(updateClock,1000)
})

const login = async () => {

  loading.value = true

  try {

    const res = await $api.post("/login", {
      email: username.value,
      password: password.value
    })

    const token = useCookie("token", {
      path: "/",
      sameSite: "lax",
      maxAge: 60 * 60 * 24
    })
    
    token.value = res.data.token

    toast.success("Login berhasil")

    await navigateTo("/dashboard")

  } catch (e) {

    toast.error("Login gagal")

  }

  loading.value = false
}
</script>


<template>

<div class="login-wrapper">

  <div class="bg-glow"></div>

  <div class="login-card">

    <div class="login-header">

      <span class="clock">{{ now }}</span>

      <div class="status">
        <span class="dot green"></span>
        <span class="dot blue"></span>
        <span class="dot orange"></span>
      </div>

    </div>


    <h2>Inventory System</h2>
    <p class="subtitle">Silakan masuk untuk melanjutkan</p>


    <div class="form">

      <div class="input-group">

        <input
        v-model="username"
        type="text"
        required
        />

        <label>Pengguna</label>

      </div>


      <div class="input-group">

        <input
        v-model="password"
        :type="showPassword?'text':'password'"
        required
        />

        <label>Kata Sandi</label>

        <span
        class="toggle"
        @click="showPassword=!showPassword"
        >
        👁
        </span>

      </div>


      <div class="remember">

        <label class="switch">

          <input type="checkbox" v-model="remember">

          <span class="slider"></span>

        </label>

        <span>Ingat selalu</span>

      </div>


      <button
      class="login-btn"
      @click="login"
      :disabled="loading"
      >

        <span v-if="loading" class="loader"></span>

        Masuk

      </button>

    </div>

  </div>

</div>

</template>


<style scoped>

/* WRAPPER */

.login-wrapper{

height:100vh;
display:flex;
align-items:center;
justify-content:center;

background:linear-gradient(135deg,#0f1117,#151821);

font-family:Inter,sans-serif;
color:white;

position:relative;
overflow:hidden;

}

/* BACKGROUND GLOW */

.bg-glow{

position:absolute;
width:600px;
height:600px;

background:radial-gradient(circle,#1f2937,transparent);

top:-200px;
right:-200px;

filter:blur(80px);

animation:float 8s infinite alternate ease-in-out;

}

/* CARD */

.login-card{

width:380px;

background:#151821;

padding:40px;

border-radius:16px;

border:1px solid #1f232c;

box-shadow:0 20px 40px rgba(0,0,0,.5);

animation:enter .5s ease;

z-index:2;

}

/* HEADER */

.login-header{

display:flex;
justify-content:space-between;
font-size:12px;
opacity:.7;
margin-bottom:20px;

}

.status{
display:flex;
gap:6px;
}

.dot{

width:12px;
height:12px;
border-radius:50%;

}

.green{background:#22c55e}
.blue{background:#60a5fa}
.orange{background:#fb923c}

/* TITLE */

h2{
text-align:center;
margin-bottom:6px;
font-weight:600;
}

.subtitle{
text-align:center;
font-size:13px;
opacity:.6;
margin-bottom:30px;
}

/* FORM */

.form{
display:flex;
flex-direction:column;
gap:20px;
}

/* INPUT */

.input-group{

position:relative;

}

.input-group input{

width:100%;
padding:12px;

border-radius:8px;

border:1px solid #2a2f3a;

background:#0f1117;

color:white;

outline:none;

transition:.2s;

}

.input-group label{

position:absolute;
left:12px;
top:12px;

font-size:13px;
opacity:.6;

transition:.2s;
pointer-events:none;

}

.input-group input:focus{

border-color:#22c55e;
box-shadow:0 0 0 2px rgba(34,197,94,.2);

}

.input-group input:focus + label,
.input-group input:valid + label{

top:-8px;
left:8px;
font-size:11px;
background:#151821;
padding:0 4px;

}

/* PASSWORD EYE */

.toggle{

position:absolute;
right:10px;
top:12px;
cursor:pointer;
opacity:.6;

}

/* REMEMBER */

.remember{

display:flex;
align-items:center;
gap:10px;

font-size:13px;
opacity:.8;

}

/* SWITCH */

.switch{

position:relative;
width:36px;
height:18px;

}

.switch input{
display:none;
}

.slider{

position:absolute;
top:0;
left:0;
right:0;
bottom:0;

background:#333;
border-radius:20px;

cursor:pointer;

}

.slider:before{

content:"";
position:absolute;

width:14px;
height:14px;

left:2px;
top:2px;

background:white;
border-radius:50%;

transition:.3s;

}

.switch input:checked + .slider{

background:#22c55e;

}

.switch input:checked + .slider:before{

transform:translateX(18px);

}

/* BUTTON */

.login-btn{

padding:14px;

background:#22c55e;

border:none;

border-radius:10px;

color:white;

font-weight:600;

cursor:pointer;

transition:.2s;

}

.login-btn:hover{

background:#16a34a;

transform:translateY(-2px);

box-shadow:0 6px 20px rgba(34,197,94,.4);

}

/* LOADER */

.loader{

border:3px solid rgba(255,255,255,.3);
border-top:3px solid white;

width:16px;
height:16px;

border-radius:50%;

display:inline-block;

animation:spin 1s linear infinite;

margin-right:6px;

}

/* ANIMATIONS */

@keyframes spin{

0%{transform:rotate(0)}
100%{transform:rotate(360deg)}

}

@keyframes enter{

from{
opacity:0;
transform:translateY(30px) scale(.95);
}

to{
opacity:1;
transform:translateY(0) scale(1);
}

}

@keyframes float{

from{
transform:translateY(0);
}

to{
transform:translateY(30px);
}

}

</style>