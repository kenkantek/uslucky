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
          <label>{{ $l('play.credit') }}: <sup class="text-danger">*</sup></label>
          <div class="input-group">
              <input type="text" class="form-control" placeholder="{{ $l('play.valid_card') }}" autofocus v-model="formInputs.number">
              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
          </div>
      </div>
      <div class="row">
          <div class="col-xs-7 col-md-7">
              <div class="">
                  <label><span class="hidden-xs">{{ $l('play.credit_expiration') }}</span>
                  <span class="visible-xs-inline">{{ $l('play.credit_exp') }}</span> {{ $l('play.credit_date') }}  <sup class="text-danger">*</sup></label>
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
                  <label>{{ $l('play.credit_cvc') }} <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="{{ $l('play.credit_cvc') }}" v-model="formInputs.cvc">
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