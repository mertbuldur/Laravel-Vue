<template>

    <div class="container">



        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="waiting-tab" data-toggle="tab" href="#waiting" role="tab" aria-controls="home" aria-selected="true">Onay Bekleyen Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Günü Gelen Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gelecek Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Geçmiş Randevular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="contact" aria-selected="false">İptal Edilen Randevular</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">
                <appointment-item @updateOkey="updateOkey" @updateCancel="updateCancel" :data="waiting.data"></appointment-item>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <pagination :data="waiting" @pagination-change-page="waitingData"></pagination>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

                <appointment-item @updateOkey="updateOkey" @updateCancel="updateCancel" :data="today.data"></appointment-item>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <pagination :data="today" @pagination-change-page="todayData"></pagination>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <appointment-item @updateOkey="updateOkey" @updateCancel="updateCancel" :data="list.data"></appointment-item>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <pagination :data="list" @pagination-change-page="listData"></pagination>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <appointment-item @updateOkey="updateOkey" @updateCancel="updateCancel" :data="last.data"></appointment-item>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <pagination :data="last" @pagination-change-page="lastData"></pagination>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                <appointment-item @updateOkey="updateOkey" @updateCancel="updateCancel" :data="cancel.data"></appointment-item>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <pagination :data="cancel" @pagination-change-page="cancelData"></pagination>
                    </div>
                </div>

            </div>
        </div>
    </div>


</template>

<script>
    import  io from  'socket.io-client';
    var socket = io('http://localhost:3000');
    export default
    {
        data(){
            return {
                waiting:{
                    data:[]
                },
                list:{
                    data:[]
                },
                today:{
                    data:[]
                },
                last:{
                    data:[]
                },
                cancel:{
                    data:[]
                }
            }
        },
        created(){
          this.getData();

            socket.on('admin_appointment_list',()=> {
                console.log("Veri Geldi");
                this.getData();
            });

        },
        methods:{
            updateCancel(id) {
                axios.post(`http://randevu.local/api/admin/process`,{
                    type:2,
                    id:id
                })
                    .then((res)=>{
                        this.getData();
                    })
            },
            updateOkey(id){
                axios.post(`http://randevu.local/api/admin/process`,{
                    type:1,
                    id:id
                })
                    .then((res)=>{
                        this.getData();
                    })
            },
            getData(url='http://randevu.local/api/admin/all'){
                axios.get(url)
                    .then(res => {
                        this.waiting = res.data.waiting;
                        this.list = res.data.list;
                        this.today = res.data.today_list;
                        this.last = res.data.last_list;
                        this.cancel = res.data.cancel;
                    });
            },
            waitingData(page){
                this.getData(`http://randevu.local/api/admin/all?waiting_page=${page}`);
            },
            listData(page){
                this.getData(`http://randevu.local/api/admin/all?list_page=${page}`);
            },
            todayData(page){
                this.getData(`http://randevu.local/api/admin/all?today_page=${page}`);
            },
            lastData(page){
                this.getData(`http://randevu.local/api/admin/all?last_page=${page}`);
            },
            cancelData(page){
                this.getData(`http://randevu.local/api/admin/all?cancel_page=${page}`);
            }
        }
    }
</script>
