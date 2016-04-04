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
          <label>CARD NUMBER: <sup class="text-danger">*</sup></label>
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Valid Card Number" autofocus v-model="formInputs.number">
              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
          </div>
          <span class="help-block" style="display: none;"></span>
      </div>
      <div class="row">
          <div class="col-xs-7 col-md-7">
              <div class="">
                  <label><span class="hidden-xs">EXPIRATION</span>
                  <span class="visible-xs-inline">EXP</span> DATE  <sup class="text-danger">*</sup></label>
                  <div class="row">
                      <div class="col-xs-8">                  
                          <select class="form-control" v-model="formInputs.exp_month">
                            <option v-for="val in date.month" v-text="val" :value="$index + 1"></option>
                          </select>
                      </div>
                      <div class="col-xs-4">
                          <select class="form-control" v-model="formInputs.exp_year">
                            <option v-for="val in date.year" v-text="val" :value="val"></option>
                          </select>
                      </div>
                  </div>
                  <span class="help-block" style="display: none;"></span>
              </div>
          </div>
          <div class="col-xs-5 col-md-5 pull-right">
              <div class="">
                  <label>CVC <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="CVC" v-model="formInputs.cvc">
                  <span class="help-block" style="display: none;"></span>
              </div>
          </div>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['formInputs'],

        data() {
            return {
                date: _date
            }
        }
    }
</script>