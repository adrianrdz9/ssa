<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new = "saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected = "startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    export default {
        props: {
          user: {
            type: Object,
            required: true
          }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
          axios.get('/agrupaciones/Admi/AdmiMsj/contacts')
            .then((response) => {
              console.log(response.data);
              this.contacts = response.data;
            });
        },
        methods: {
          startConversationWith(contact){
            axios.get('/agrupaciones/Admi/AdmiMsj/conversation/' + contact.id)
              .then((response)=>{
                this.messages = response.data;
                this.selectedContact = contact;
              })
          },
          saveNewMessage(text){
            console.log(this.messages);
            this.messages.push(text);
          }
        },
        components: {Conversation, ContactsList}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
