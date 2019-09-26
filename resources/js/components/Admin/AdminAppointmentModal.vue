<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <h3 slot="header">{{data.fullName}}

                                <button class="btn btn-danger modal-default-button" @click="$emit('close')">
                                    X
                                </button>
                            </h3>

                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <div>
                                <div>
                                    <span>Telefon</span>:<span>{{ data.phone }}</span>
                                </div>
                                <div>
                                    <span>Email</span>:<span>{{ data.email }}</span>
                                </div>
                                <div>
                                    <span>Tarih</span>:<span>{{ data.date }}</span>
                                </div>
                                <div>
                                    <span>Saat</span>:<span>{{ data.working }}</span>
                                </div>
                                <div>
                                    <span>Bildirim Tipi</span>:<span>{{ data.notification }}</span>
                                </div>
                                <div>
                                    <span>Not</span>:<span>{{ data.text }}</span>
                                </div>
                            </div>



                        </slot>

                        <div style="border-top:1px solid #ddd;padding:10px 0px;">
                            <div v-for="item in comment">{{ item.text }}</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">

                            <div>
                                <textarea v-model="text" class="form-control" id="" cols="30" rows="5"></textarea>
                                <button  @click="store" style="margin-top:2px;" class=" btn btn-primary">Gönder!</button>
                            </div>

                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export  default
    {
        props:['modalId'],
        data(){
            return {
                data:[],
                comment:[],
                text:'',
            }
        },
        created()
        {
           this.getData();
        },
        methods:{
            store:function () {
                axios.post(`http://randevu.local/api/admin/detail`,{
                    id:this.modalId,
                    text:this.text
                }).then((res)=>{

                    if(res.status)
                    {
                        this.text = '';
                        this.getData();
                    }
                })
            },
            getData:function () {
                axios.get(`http://randevu.local/api/admin/detail/${this.modalId}`)
                    .then((res)=>{
                        this.data = res.data.data;
                        this.comment = res.data.comment;
                    });
            }
        }
    }
</script>
