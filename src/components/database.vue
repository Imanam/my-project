<template>
    <table border='1' width='100%' style='border-collapse: collapse;'>
   <tr>
     <th>Name</th>
     <th>Email</th>
     <th>Country</th>
     <th>City</th>
     <th>Job</th>

   </tr>

   <tr v-for='contact in contacts'>
     <td>{{ contact.name }}</td>
     <td>{{ contact.email }}</td>
     <td>{{ contact.password }}</td>
   </tr>
 </table>
</template>

<script>

export default {
    data : () => {
        return {
            name:'',
            email:'',
            password:'',
        }
    },
    mounted : () => {
        console.log('Hello from Vue!')
        this.getContact()
    },
    methods : {
        getContacts : () =>{
            
        }
    }
}

</script>
