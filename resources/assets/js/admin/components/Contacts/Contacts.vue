<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" v-if="contacts.length">
            <thead>
                <tr>
                    <th> ID # </th>
                    <th> Cust. Name </th>
                    <th> Cust. Email </th>
                    <th> Date/Time </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" track-by="$index">
                    <td>
                        <a :href="contact.url">{{contact.id}}</a>
                    </td>
                    <td> <a :href="contact.url">{{contact.name}} </a></td>
                    <td>
                        <a href="mailto:{{contact.email}}"> {{contact.email}} </a>
                    </td>
                    <td class="center"> {{contact.created_at}}</td>
                    <td>

                        <span v-if="contact.status === 'unread'" class="label label-sm label-warning"> {{contact.status}} </span>
                        <span v-if="contact.status === 'read'" class="label label-sm label-info"> {{contact.status}} </span>
                        <span v-if="contact.status === 'replied'" class="label label-sm label-success"> {{contact.status}} </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <div class="note note-info">
                <h4 class="block">*You have not contacts!</h4>
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
            this._fetchContact(laroute.route('admin.get.contacts'), this.numberMore).done(contacts => {
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