<template>
    <div>
    <div class="row">
            <div v-for="item in data"  @click="openModal(item.id)" class="col-md-4">
                <div class="card appointment-card">
                    <span class="appointment-number">Randevu

                        <span class="new-appointment bg-yellow" v-if="item.isActive == 0">Yeni</span>
                        <span class="new-appointment bg-green" v-if="item.isActive == 1">Onaylı</span>
                        <span class="new-appointment" v-if="item.isActive == 2">İptal Edilen</span>

                    </span>
                    <div class="appointment-detail">
                        <span>{{item.fullName}}</span>
                        <span>{{item.date}}</span>
                        <span>{{ item.working}}</span>

                    </div>

                    <div class="appointment-buttons" v-if="!item.isActive">
                        <button @click="appointmentOkey(item.id)">Onayla</button>
                        <button @click="appointmentCancel(item.id)">İptal Et</button>
                    </div>
                </div>
            </div>
    </div>
    <admin-appointment-modal :modalId="showModalId" v-if="showModal" @close="showModal = false"></admin-appointment-modal>
    </div>
</template>

<script>
    export default
    {
        props:['data'],
        data(){
            return{
                showModalId:0,
                showModal:false
            }
        },
        created()
        {

        },
        methods:{
            appointmentOkey:function (id) {
                this.$emit('updateOkey',id)
            },
            appointmentCancel:function (id) {
                this.$emit('updateCancel',id)
            },
            openModal:function (id) {
                this.showModalId = id;
                this.showModal = true
            }
        }
    }
</script>
