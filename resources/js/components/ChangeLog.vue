<template>
  <div id="timeline" class="pt-4">
    <div class="list-group mb-4 ml-4 w-25 fixed-bottom">
        <a :href="'#'+date" v-for="date of dates" :key="date" class="list-group-item list-group-item-action ">
            {{ date }}
        </a>
    </div>

    <div class="timeline">
      <div class="container right" :id="moment(item.created_at).format('MMMM[/]YYYY')" v-for="item of items" :key="item.id">
        <div class="content">
          <h2>{{ moment(item.created_at).format('D [de] MMMM [de] YYYY') }}</h2>
          <strong>{{ item.author.name }}  {{ item.author.last_name }} </strong>
          <strong>{{ item.author.Siglas }}  {{ item.author.Nombre }} </strong>
          <p>{{ item.change }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default { 
  data() {
    return {
      items: [],
      moment: window.moment,
      dates: []
    };
  },

  created() {
    axios.get("/s/cl").then(response => {
        this.items = response.data;
        console.log(response);


        this.items.forEach(el => {
            let date = this.moment(el.created_at).format('MMMM[/]YYYY');

            if(this.dates.indexOf(date) == -1){
                this.dates.push(date);
            }
        });
    });
  },
};
</script>
