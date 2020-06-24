import {Component, OnInit} from '@angular/core';
import {AlertController, NavController, ToastController} from '@ionic/angular';
import {NewsDataService} from '../services/news-data.service';

@Component({
    selector: 'app-home',
    templateUrl: 'home.page.html',
    styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
    searchData: any[] = [];

    public searchBarOpen = false;
    constructor(public dataService: NewsDataService, private alertCtrl: AlertController, public toastController: ToastController) {
    }

    ngOnInit() {
    }

    filterSearchData(ev: any) {
        const value = ev.target.value;
        if (value && value.trim() !== '') {
            this.searchData = this.searchData.filter((item) => {
                return (item.name.toLowerCase().indexOf(value.toLowerCase()) >= 0);
            });
        }
    }

    initSearchData() {
        if (this.searchData.length <= this.dataService.articles.length) {
            for (let i = 0; i < this.dataService.articles.length; i++) {
                this.searchData.push({
                    name: this.dataService.articles[i].id
                });
            }
        } else {
            return null;
        }
    }

    createArticle() {
        this.alertCtrl.create({
            header: 'Create Article',
            message: 'Enter article information below',
            inputs: [
                {
                    type: 'text',
                    name: 'name',
                    placeholder: 'Title'
                },
                {
                    type: 'text',
                    name: 'description',
                    placeholder: 'Description'
                },
                {
                  type: 'text',
                  name: 'extDescription',
                  placeholder: 'Article Text'
                },
                {
                    type: 'url',
                    name: 'url',
                    placeholder: 'Image URL'
                }
            ],
            buttons: [
                {
                    text: 'Cancel'
                },
                {
                    text: 'Create',
                    handler: data => {
                        this.openCreateToast();
                        this.dataService.createArticle(data);
                    }
                }
            ]
        })
            .then(prompt => {
                prompt.present();
            });
    }

    updateArticle(article) {
        this.alertCtrl.create({
            header: 'Rename Article',
            message: 'Enter article name:',
            inputs: [
                {
                    type: 'text',
                    name: 'name',
                    placeholder: 'Title'
                },
                {
                    type: 'text',
                    name: 'description',
                    placeholder: 'Description'
                },
                {
                    type: 'text',
                    name: 'extDescription',
                    placeholder: 'Article Text'
                },
                {
                    type: 'url',
                    name: 'url',
                    placeholder: 'Image URL'
                }
            ],
            buttons: [
                {
                    text: 'Cancel'
                },
                {
                    text: 'Save',
                    handler: data => {
                        this.openUpdateToast();
                        this.dataService.updateArticle(article, data);
                    }
                }
            ]
        })
            .then(prompt => {
                prompt.present();
            });
    }

    deleteArticle(article) {
            this.openDeleteToast();
            this.dataService.deleteArticle(article);
    }

    async openCreateToast() {
        const toast = await this.toastController.create({
            message: 'Your article has been created.',
            duration: 3000,
            showCloseButton: true,
            closeButtonText: 'Dismiss'
        });
        toast.present();
    }

    async openUpdateToast() {
        const toast = await this.toastController.create({
            message: 'Your article has been updated.',
            duration: 3000,
            showCloseButton: true,
            closeButtonText: 'Dismiss'
        });
        toast.present();
    }

    async openDeleteToast() {
        const toast = await this.toastController.create({
            message: 'Your article has been deleted',
            duration: 3000,
            showCloseButton: true,
            closeButtonText: 'Dismiss'
        });
        toast.present();
    }
}
