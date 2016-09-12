<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" v-if="contacts.length">
            <thead>
                <tr>
                    <th> ID # </th>
                    <th> Comapny Name </th>
                    <th> Comapny Address </th>
                    <th> Comapny Zipcode </th>
                    <th> Comapny Phone </th>
                    <th> Contact Person </th>
                    <th> Cell phone </th>
                    <th> Date/Time </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" track-by="$index">
                    <td v-text="contact.id"></td>
                    <td v-text="contact.name"></td>
                    <td v-text="contact.address"></td>
                    <td v-text="contact.zipcode"></td>
                    <td v-text="contact.phone"></td>
                    <td v-text="contact.contact_person"></td>
                    <td v-text="contact.cell_phone"></td>
                    <td v-text="contact.created_at"></td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <div class="note note-info">
                <h4 class="block">*You have not contact of partnership!</h4>
            </div>
        </div>
    </div>
    <button style="width: 100%" class="btn btn-primary" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">Load more {{ numberMore }} record</button>
    <div v-show="nextPageUrl" style="width: 100%;text-align: center;margin-top: 15px">
        Show {{ contacts.length }} of {{ totalContacts }} record.
    </div>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                contacts: [],
                numberMore: 10,
                loading: false,
                totalContacts: null,
                nextPageUrl: null
            }
        },

        asyncData(resolve, reject) {
            this._fetchContact(laroute.route('admin.api.get.partners'), this.numberMore).done(contacts => {
                resolve({
                    contacts
                });
            }, err => {
                COMMON.alertError();
            });
        },
   
        methods: {
            _fetchContact(api, take = this.numberMore) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                    this.loading = false;
                    this.totalContacts = data.total;
                    this.nextPageUrl = data.next_page_url;
                    def.resolve(data.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
            nextPagination() {
                this._fetchContact(this.nextPageUrl).done(contacts => {
                    this.contacts = this.contacts.concat(contacts);
                }, err => {
                    COMMON.alertError();
                });
            }
        },
}
</script>