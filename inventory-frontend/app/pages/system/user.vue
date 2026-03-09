```vue
<script setup>
import { ref, reactive, computed, onMounted } from "vue"
import { useToast } from "vue-toastification"

const { $api } = useNuxtApp()
const toast = useToast()

definePageMeta({
  layout: "dashboard"
})

const users = ref([])
const kelompokUsers = ref([])
const search = ref("")
const showModal = ref(false)
const editMode = ref(false)

const form = reactive({
  id: null,
  name: "",
  email: "",
  password: "",
  kelompok_user_id: null
})

const loadUsers = async () => {
  try {
    const res = await $api.get("/users")
    users.value = res.data
  } catch {
    toast.error("Failed load users")
  }
}

const loadKelompok = async () => {
  try {
    const res = await $api.get("/kelompok-users")
    kelompokUsers.value = res.data
  } catch {
    toast.error("Failed load roles")
  }
}

onMounted(async () => {
  await loadUsers()
  await loadKelompok()
})

const filteredUsers = computed(() => {
  return users.value.filter((u) =>
    u.name?.toLowerCase().includes(search.value.toLowerCase())
  )
})

const initials = (name) => (name ? name.charAt(0).toUpperCase() : "U")

const kelompokName = (id) => {
  const k = kelompokUsers.value.find((x) => x.id === id)
  return k ? k.nama_kelompok : "-"
}

const createUser = async () => {
  try {
    await $api.post("/users", form)

    toast.success("User created successfully")

    resetForm()
    showModal.value = false

    loadUsers()
  } catch {
    toast.error("Failed create user")
  }
}

const editUser = (user) => {
  form.id = user.id
  form.name = user.name
  form.email = user.email
  form.kelompok_user_id = user.kelompok_user_id

  editMode.value = true
  showModal.value = true
}

const updateUser = async () => {
  try {
    await $api.put(`/users/${form.id}`, form)

    toast.success("User updated")

    resetForm()
    showModal.value = false

    loadUsers()
  } catch {
    toast.error("Failed update user")
  }
}

const deleteUser = async (id) => {
  if (!confirm("Delete user?")) return

  try {
    await $api.delete(`/users/${id}`)

    toast.success("User deleted")

    loadUsers()
  } catch {
    toast.error("Failed delete user")
  }
}

const resetForm = () => {
  form.id = null
  form.name = ""
  form.email = ""
  form.password = ""
  form.kelompok_user_id = null

  editMode.value = false
}
</script>

<template>
  <div class="page">

    <div class="page-header">
      <h1 class="title">User Management</h1>

      <div class="header-actions">
        <button class="btn-secondary">
          Export
        </button>

        <button
          @click="showModal = true"
          class="btn-primary"
        >
          + Add User
        </button>
      </div>
    </div>

    <div class="toolbar">
      <input
        v-model="search"
        placeholder="Search users..."
        class="search-input"
      />
    </div>

    <div class="table-container">
      <table class="table">

        <thead>
          <tr>
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>

        <tbody>

          <tr
            v-for="user in filteredUsers"
            :key="user.id"
            class="table-row"
          >

            <td>
              <div class="user-cell">
                <div class="avatar">
                  {{ initials(user.name) }}
                </div>

                <span class="user-name">
                  {{ user.name }}
                </span>
              </div>
            </td>

            <td class="text-muted">
              {{ user.email }}
            </td>

            <td>
              <span class="badge-role">
                {{ kelompokName(user.kelompok_user_id) }}
              </span>
            </td>

            <td>
              <span class="badge-active">
                Active
              </span>
            </td>

            <td class="action-cell">

              <div class="action-buttons">

                <button
                  @click="editUser(user)"
                  class="btn-action edit"
                >
                  Edit
                </button>

                <button
                  @click="deleteUser(user.id)"
                  class="btn-action delete"
                >
                  Delete
                </button>

              </div>

            </td>

          </tr>

        </tbody>

      </table>
    </div>

    <transition name="modal">

      <div
        v-if="showModal"
        class="modal-overlay"
      >

        <div class="modal-box">

          <h2 class="modal-title">
            {{ editMode ? "Edit User" : "Create User" }}
          </h2>

          <input
            v-model="form.name"
            placeholder="Name"
            class="input"
          />

          <input
            v-model="form.email"
            placeholder="Email"
            class="input"
          />

          <input
            v-if="!editMode"
            v-model="form.password"
            type="password"
            placeholder="Password"
            class="input"
          />

          <select
            v-model="form.kelompok_user_id"
            class="input"
          >

            <option :value="null">
              Select Role
            </option>

            <option
              v-for="k in kelompokUsers"
              :key="k.id"
              :value="k.id"
            >
              {{ k.nama_kelompok }}
            </option>

          </select>

          <div class="modal-actions">

            <button
              @click="showModal = false"
              class="btn-cancel"
            >
              Cancel
            </button>

            <button
              v-if="editMode"
              @click="updateUser"
              class="btn-primary"
            >
              Update
            </button>

            <button
              v-else
              @click="createUser"
              class="btn-primary"
            >
              Save
            </button>

          </div>

        </div>

      </div>

    </transition>

  </div>
</template>

<style scoped>

.page{
  padding:32px;
}

.page-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
}

.title{
  font-size:24px;
  font-weight:600;
  color:white;
}

.header-actions{
  display:flex;
  gap:10px;
}

.toolbar{
  margin-bottom:20px;
}

.search-input{
  width:280px;
  background:#1e293b;
  border:1px solid #334155;
  padding:10px;
  border-radius:8px;
  color:white;
}

.table-container{
  background:#020617;
  border:1px solid #1e293b;
  border-radius:12px;
  overflow:hidden;
}

.table{
  width:100%;
  font-size:14px;
}

.table th{
  background:#020617;
  color:#94a3b8;
  text-align:left;
  padding:14px;
}

.table td{
  padding:14px;
}

.table-row{
  border-top:1px solid #1e293b;
  transition:.2s;
}

.table-row:hover{
  background:#1e293b;
}

.user-cell{
  display:flex;
  align-items:center;
  gap:10px;
}

.user-name{
  color:white;
  font-weight:500;
}

.avatar{
  width:34px;
  height:34px;
  border-radius:50%;
  background:#2563eb;
  display:flex;
  align-items:center;
  justify-content:center;
  color:white;
  font-weight:600;
}

.badge-role{
  background:#1e293b;
  padding:4px 10px;
  border-radius:6px;
  font-size:12px;
}

.badge-active{
  background:rgba(34,197,94,0.2);
  color:#22c55e;
  padding:4px 10px;
  border-radius:6px;
  font-size:12px;
}

.text-muted{
  color:#94a3b8;
}

.btn-primary{
  background:#2563eb;
  padding:8px 16px;
  border-radius:8px;
  color:white;
  transition:.2s;
}

.btn-primary:hover{
  background:#1d4ed8;
}

.btn-secondary{
  background:#1e293b;
  border:1px solid #334155;
  padding:8px 16px;
  border-radius:8px;
  color:#cbd5f5;
}

.btn-secondary:hover{
  background:#334155;
}

.btn-cancel{
  background:#334155;
  padding:8px 16px;
  border-radius:8px;
  color:white;
}

.action-cell{
  text-align:right;
}

.action-buttons{
  display:flex;
  justify-content:flex-end;
  gap:8px;
}

.btn-action{
  font-size:13px;
  padding:6px 12px;
  border-radius:6px;
  border:none;
  cursor:pointer;
  transition:.15s;
}

.btn-action.edit{
  background:#1e293b;
  color:#60a5fa;
}

.btn-action.edit:hover{
  background:#2563eb;
  color:white;
}

.btn-action.delete{
  background:#1e293b;
  color:#f87171;
}

.btn-action.delete:hover{
  background:#dc2626;
  color:white;
}

.modal-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.65);
  display:flex;
  align-items:center;
  justify-content:center;
}

.modal-box{
  background:#020617;
  padding:24px;
  border-radius:12px;
  width:380px;
}

.modal-title{
  font-size:18px;
  color:white;
  margin-bottom:14px;
}

.input{
  width:100%;
  background:#1e293b;
  border:1px solid #334155;
  padding:10px;
  border-radius:8px;
  margin-bottom:10px;
  color:white;
}

.modal-actions{
  display:flex;
  justify-content:flex-end;
  gap:10px;
  margin-top:10px;
}

.modal-enter-active,
.modal-leave-active{
  transition:.2s;
}

.modal-enter-from{
  opacity:0;
  transform:scale(.95);
}

.modal-leave-to{
  opacity:0;
  transform:scale(.95);
}

</style>
```
