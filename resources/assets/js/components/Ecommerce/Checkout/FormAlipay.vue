<style scoped>
    .main-credit {
        margin-top: 20px;
    }
    .main-credit label{
        padding-left: 0px;
        font-weight: bold;
    }
    .main-credit .section {
        margin-bottom: 10px;
    }
</style>
<template>
    <div class="main-credit">
      <div class="section">
          <label>电邮: <sup class="text-danger">*</sup></label>
          <div class="input-group">
              <input type="text" @change.prevent="onKeyup(formInputs.email)" class="form-control" placeholder="电邮" autofocus v-model="formInputs.email"/>
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
          </div>
      </div>
        <div class="section" v-show="loading">
            <center><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>
        </div>
      <div class="section" v-show="show">
          <label>验证码短信: <sup class="text-danger">*</sup></label>
          <div class="input-group">
              <input type="text" class="form-control" placeholder="123456" autofocus v-model="formInputs.sms_code">
              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
          </div>
      </div>
        <div class="section" v-show="show">
            <label>最近5身份证号码: <sup class="text-danger">*</sup></label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="身份证号码后5位" autofocus v-model="formInputs.id5">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['formInputs','sms_id','total'],

        data() {
            return {
                date: _date,
                stripe: _stripKey,
                show: false,
                loading: false,
            }
        },

        methods: {
            onKeyup(email){
                    this.loading = true;
                    this.$http.post('https://api.stripe.com/v1/alipay/send_sms?alipay_username='+email+'&reusable=false&amount='+this.total+'00&currency=usd&description_in_sms=stripe.com%3A+2+widgets+(%24'+this.amount+')&key='+this.stripe).then(res => {
                        this.sms_id = res.data.id;
                        this.loading = false;
                        this.show = true;
                    });
                }
            }
    }
</script>