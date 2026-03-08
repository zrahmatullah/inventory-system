<template>

<div class="dashboard">

  <!-- SIDEBAR -->
  <aside class="sidebar">

    <div class="sidebar-top">

      <div class="avatar"></div>
      <span class="username">Inventory</span>

    </div>

    <nav class="menu">

      <p class="menu-title">DASHBOARDS</p>

      <NuxtLink to="/dashboard" class="menu-item active">
        Overview
      </NuxtLink>

      <NuxtLink to="/issues" class="menu-item">
        Issues
      </NuxtLink>

      <NuxtLink to="/sales" class="menu-item">
        Sales
      </NuxtLink>

      <NuxtLink to="/traffic" class="menu-item">
        Traffic
      </NuxtLink>

      <NuxtLink to="/data" class="menu-item">
        Data
      </NuxtLink>


      <p class="menu-title">USERS</p>

      <NuxtLink to="/users" class="menu-item">
        Users
      </NuxtLink>

      <NuxtLink to="/settings" class="menu-item">
        Settings
      </NuxtLink>

    </nav>

    <div class="sidebar-bottom">
      <NuxtLink to="/logout">Logout</NuxtLink>
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

</style>