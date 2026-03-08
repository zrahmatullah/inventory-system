<script setup>
import { ref, onMounted } from "vue"
import { useToast } from "vue-toastification"

const { $api } = useNuxtApp()
const router = useRouter()

const user = ref(null)
const showLogoutModal = ref(false)
const loadingLogout = ref(false)

onMounted(async () => {
  try {
    const res = await $api.get("/me")
    user.value = res.data
  } catch (err) {
    console.log(err)
  }
})

const confirmLogout = () => {
  showLogoutModal.value = true
}

const cancelLogout = () => {
  showLogoutModal.value = false
}

const logout = async () => {
  loadingLogout.value = true

  try {
    const res = await $api.post("/logout")

    if (res.data.success) {
      toast.success("Berhasil logout")
    }

    localStorage.removeItem("token")

    setTimeout(() => {
      router.push("/login")
    }, 800)

  } catch (error) {
    toast.error("Logout gagal")
    router.push("/login")
  }
}
</script>



<template>

<div class="dashboard">

  <!-- SIDEBAR -->
  <aside class="sidebar">

    <div class="sidebar-top">

      <div class="avatar"></div>

      <span class="username">
        {{ user?.name || 'Inventory' }}
      </span>

    </div>

    <nav class="menu">

      <p class="menu-title">DASHBOARDS</p>

      <NuxtLink to="/dashboard" class="menu-item" active-class="active">
        Overview
      </NuxtLink>

      <NuxtLink to="/issues" class="menu-item" active-class="active">
        Issues
      </NuxtLink>

      <NuxtLink to="/sales" class="menu-item" active-class="active">
        Sales
      </NuxtLink>

      <NuxtLink to="/traffic" class="menu-item" active-class="active">
        Traffic
      </NuxtLink>

      <NuxtLink to="/data" class="menu-item" active-class="active">
        Data
      </NuxtLink>


      <p class="menu-title">USERS</p>

      <NuxtLink to="/users" class="menu-item" active-class="active">
        Users
      </NuxtLink>

      <NuxtLink to="/settings" class="menu-item" active-class="active">
        Settings
      </NuxtLink>

    </nav>

    <div class="sidebar-bottom">
      <button class="logout-btn" @click="confirmLogout">
        Logout
      </button>
    </div>
  </aside>


  <!-- MAIN CONTENT -->
  <div class="main">

    <!-- TOPBAR -->
    <header class="topbar">

      <div class="left">
        <button class="project-btn">All Projects</button>
        <button class="new-btn">+ new</button>
      </div>

      <div class="right">

        <div class="icon"></div>
        <div class="icon"></div>

        <div class="avatar-small"></div>

      </div>

    </header>


    <!-- PAGE CONTENT -->
    <div class="page">

      <slot />

    </div>

  </div>

</div>

<!-- LOGOUT MODAL -->
<div v-if="showLogoutModal" class="modal-overlay">

  <div class="modal">

    <h3>Logout</h3>

    <p>Apakah Anda yakin ingin keluar dari sistem?</p>

    <div class="modal-actions">

      <button class="cancel-btn" @click="cancelLogout">
        Batal
      </button>

      <button class="confirm-btn" @click="logout" :disabled="loadingLogout">
        {{ loadingLogout ? "Processing..." : "Logout" }}
      </button>

    </div>

  </div>

</div>

</template>

<style scoped>

.dashboard{
display:flex;
height:100vh;
background:#0f1117;
color:white;
font-family:Inter, sans-serif;
}


/* SIDEBAR */

.sidebar{
width:240px;
background:#0b0d12;
display:flex;
flex-direction:column;
padding:20px;
border-right:1px solid #1c1f26;
}

.sidebar-top{
display:flex;
align-items:center;
gap:10px;
margin-bottom:30px;
}

.avatar{
width:32px;
height:32px;
border-radius:50%;
background:#333;
}

.username{
font-weight:600;
}

.menu{
flex:1;
}

.menu-title{
font-size:11px;
opacity:.6;
margin:20px 0 10px;
}

.menu-item{
display:block;
padding:10px;
border-radius:8px;
color:#cbd5f5;
text-decoration:none;
margin-bottom:4px;
}

.menu-item:hover{
background:#1b1f2a;
}

.menu-item.active{
background:#1f2430;
color:white;
}

.sidebar-bottom{
margin-top:20px;
font-size:14px;
}


/* MAIN */

.main{
flex:1;
display:flex;
flex-direction:column;
}


/* TOPBAR */

.topbar{
height:60px;
border-bottom:1px solid #1c1f26;
display:flex;
align-items:center;
justify-content:space-between;
padding:0 25px;
}

.project-btn{
background:#1f2430;
border:none;
color:white;
padding:8px 14px;
border-radius:8px;
}

.new-btn{
margin-left:10px;
background:transparent;
border:1px dashed #444;
color:white;
padding:8px 14px;
border-radius:8px;
}

.right{
display:flex;
align-items:center;
gap:15px;
}

.icon{
width:30px;
height:30px;
background:#1f2430;
border-radius:6px;
}

.avatar-small{
width:32px;
height:32px;
background:#444;
border-radius:50%;
}


/* PAGE */

.page{
padding:25px;
overflow:auto;
}

/* OVERLAY */

.modal-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.65);
  display:flex;
  align-items:center;
  justify-content:center;
  z-index:1000;
  backdrop-filter:blur(6px);
}


/* MODAL BOX */

.modal{
  width:340px;
  background:#11141c;
  border-radius:14px;
  padding:26px;
  text-align:center;
  box-shadow:0 15px 40px rgba(0,0,0,0.6);
  border:1px solid #1f2430;
  color:#e5e7eb;
}


/* TITLE */

.modal h3{
  margin:0 0 10px;
  font-size:18px;
  font-weight:600;
  color:#ffffff;
}


/* TEXT */

.modal p{
  margin:0 0 22px;
  font-size:14px;
  line-height:1.5;
  color:#cbd5e1;
}


/* BUTTON AREA */

.modal-actions{
  display:flex;
  gap:10px;
}


/* CANCEL BUTTON */

.cancel-btn{
  flex:1;
  background:#1f2430;
  border:none;
  padding:10px;
  border-radius:8px;
  color:#e5e7eb;
  cursor:pointer;
  transition:0.2s;
}

.cancel-btn:hover{
  background:#2b3140;
}


/* CONFIRM LOGOUT BUTTON */

.confirm-btn{
  flex:1;
  background:#ef4444;
  border:none;
  padding:10px;
  border-radius:8px;
  color:white;
  cursor:pointer;
  transition:0.2s;
}

.confirm-btn:hover{
  background:#dc2626;
}


/* SIDEBAR LOGOUT BUTTON */

.logout-btn{
  width:100%;
  background:#1f2430;
  border:none;
  padding:10px;
  border-radius:8px;
  color:#e5e7eb;
  cursor:pointer;
  transition:0.2s;
}

.logout-btn:hover{
  background:#2b3140;
}

</style>