<script setup>

definePageMeta({
  layout: "dashboard",
  middleware: "auth"
})

const series = [
  {
    name: "Open",
    data: [10,20,30,40,50,60,80]
  },
  {
    name: "In Progress",
    data: [5,10,20,30,45,50,60]
  }
]

const chartOptions = {

  chart:{
    background:"transparent",
    toolbar:{show:false}
  },

  theme:{
    mode:"dark"
  },

  stroke:{
    curve:"smooth",
    width:3
  },

  grid:{
    borderColor:"#1f232c"
  },

  xaxis:{
    categories:["Jan","Mar","May","Jul","Sep","Nov","Dec"],
    labels:{
      style:{ colors:"#aaa" }
    }
  },

  yaxis:{
    labels:{
      style:{ colors:"#aaa" }
    }
  },

  legend:{
    labels:{ colors:"#ddd" }
  }

}

</script>

<template>

<div class="dashboard">

  <!-- PAGE TITLE -->
  <div class="header">

    <div>
      <h2>Distribution of Effort</h2>
      <p>Overview of issue progress over time</p>
    </div>

    <div class="filters">
      <button class="filter">Backlog</button>
      <button class="filter">Frontend</button>
    </div>

  </div>



  <!-- MAIN CHART -->

  <div class="chart-card">

    <ClientOnly>
      <ApexChart
        type="line"
        height="320"
        :options="chartOptions"
        :series="series"
      />
    </ClientOnly>

  </div>



  <!-- STATS GRID -->

  <div class="grid">

    <div class="card">

      <div class="card-header">
        <h3>Type Distribution</h3>
        <span>Issue distribution by category</span>
      </div>

      <ClientOnly>
        <ApexChart
          type="bar"
          height="260"
          :options="chartOptions"
          :series="series"
        />
      </ClientOnly>

    </div>



    <div class="card">

      <div class="card-header">
        <h3>Bugs Distribution</h3>
        <span>Specific breakdown of bug reports</span>
      </div>

      <ClientOnly>
        <ApexChart
          type="bar"
          height="260"
          :options="chartOptions"
          :series="series"
        />
      </ClientOnly>

    </div>

  </div>

</div>

</template>



<style scoped>

/* PAGE */

.dashboard{
width:100%;
padding:10px 5px;
}

/* HEADER */

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.header h2{
font-size:22px;
font-weight:600;
color:white;
margin-bottom:4px;
}

.header p{
font-size:13px;
color:#888;
}

.filters{
display:flex;
gap:10px;
}

.filter{
background:#1a1e27;
border:1px solid #2a2f3a;
color:#ddd;
padding:6px 12px;
border-radius:8px;
font-size:13px;
cursor:pointer;
transition:0.2s;
}

.filter:hover{
background:#232938;
}

/* MAIN CHART */

.chart-card{

background:#151821;

padding:25px;

border-radius:14px;

border:1px solid #1f232c;

margin-bottom:25px;

box-shadow:0 4px 20px rgba(0,0,0,0.25);

}

/* GRID */

.grid{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;

}

/* CARD */

.card{

background:#151821;

padding:22px;

border-radius:14px;

border:1px solid #1f232c;

transition:0.25s;

}

.card:hover{

transform:translateY(-3px);

border-color:#2c3240;

box-shadow:0 8px 25px rgba(0,0,0,0.3);

}

/* CARD HEADER */

.card-header{
margin-bottom:10px;
}

.card-header h3{
font-size:16px;
font-weight:600;
color:#fff;
margin-bottom:4px;
}

.card-header span{
font-size:12px;
color:#888;
}

</style>