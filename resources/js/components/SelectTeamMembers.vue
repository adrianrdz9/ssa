<template>
    <div class="container">
        <h3>Seleccionar capitan</h3>

         <div class="row">
            <div class="col-9">
                <select name="captain_id" id="captain" class="form-control">
                    <option v-for="user of users" :key="user.id" :value="user.id">{{ user.account_number }} - {{ user.name }} {{ user.last_name }}</option>
                </select>
            </div>
        </div>

        <h3>Seleccionar integrantes del equipo</h3>

        <ul class="list-group">
            Intgrantes:
            <li v-for="user of selectedUsers" :key="user.id" class="list-group-item">

                {{ user.account_number }} - {{ user.name }} {{ user.last_name }}
                <button type="button" class="btn btn-danger btn-small" @click="removeUser(user.id)">X</button>
            </li>
        </ul>

        <input type="hidden" name="members[]" :value="selectedUser.id" v-for="selectedUser of selectedUsers" :key="selectedUser.id">

        <div class="row">
            <div class="col-9">
                <select name="" id="users" v-model="selection" class="form-control">
                    <option v-for="user of users" :key="user.id" :value="user.id">{{ user.account_number }} - {{ user.name }} {{ user.last_name }}</option>
                </select>
            </div>

            <div class="col-3">
                <button @click="addUser" class="btn btn-info" style="width: 100%" type="button">Agregar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {


    data(){
        return {
            users: [],
            selectedUsers: [],
            selection: ""
        }
    },

    created(){
        axios.get('/actividades-deportivas/admin/teams/create').then(response =>{
            this.users = response.data
            this.users = this.users.sort();
        }); 
    },

    methods: {
        addUser(){
            this.users = this.users.filter((usr)=>{
                if(usr.id == this.selection){
                    this.selectedUsers.push(usr)
                    return false;
                }

                return true;
            });

            this.users = this.users.sort();
        },

        removeUser(id){
            this.selectedUsers = this.selectedUsers.filter((usr) => {
                if(usr.id == id){
                    this.users.push(usr);
                    return false;
                }

                return true;
            })

            this.users = this.users.sort();
        }
    }
}
</script>


