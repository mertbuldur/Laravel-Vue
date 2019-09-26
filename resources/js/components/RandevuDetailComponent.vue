<template>
    <div>
        <div>
            <div class="container">
                <div class="main">
                    <h2>Randevu Takip Sistemi</h2>
                    <h3>Randevunuzu görmek için bilgileri doğru giriniz.</h3>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li class="errors" v-for="i in errors">
                                {{ i }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control"  v-model="code" placeholder="Randevu Kodu">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button v-on:click="store" class="btn btn-success">Randevu Ara</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="completeForm">

                <div class="container">
                    <div style="margin-top:15px;" class="main">
                    <div class="row">
                        <div class="col-md-12">
                            Tarih: {{ info.date }}
                        </div>
                        <div class="col-md-12">
                            Saat: {{info.working}}
                        </div>
                        <div class="col-md-12">
                            Bildirim Tipi: {{info.notification}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" v-for="item in note">
                            <span>{{item.text}}</span>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        data()
        {
            return{
                code:null,
                errors:[],
                completeForm:false,
                info:[],
                note:[]
            }
        },
        methods:{
            store:function()
            {

                if(this.code!=null) {
                    axios.post(`http://randevu.local/api/appointment-detail`, {
                        code: this.code
                    })
                        .then((res) => {
                            if(res.data.status)
                            {
                                this.code = ''
                                this.info = res.data.info;
                                this.note = res.data.note;
                                this.completeForm = true;
                            }
                            else
                            {
                                this.errors = [];
                                this.errors.push(res.data.message);
                            }
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                }

                this.errors = [];
                if(this.code==null) {
                    this.errors.push('Randevu Kodu Boş Bırakılamaz');
                }



            }
        }
    }
</script>
