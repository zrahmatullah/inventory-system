<script setup>

const { $api } = useNuxtApp()
const result = ref(null)

const getApi = async () => {

  try {

    const res = await $api.get('/test')

    result.value = res.data

  } catch (error) {

    console.error(error)

  }

}

onMounted(() => {
  getApi()
})

</script>

<template>

<div>

<h2>Test API Laravel</h2>

<pre>{{ result }}</pre>

</div>

</template>