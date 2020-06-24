import {NewsDataService} from '../services/news-data.service';
import {Article} from '../interfaces/article';
import {AlertController} from '@ionic/angular';
import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';

@Component({templateUrl: './detail.page.html', styleUrls: ['./detail.page.scss']})
export class DetailPage implements OnInit {
    private id: string;
    public article: Article;

    constructor(private alertCtrl: AlertController, private route: ActivatedRoute, private dataService: NewsDataService) {
    }

    ngOnInit() {
        this.id = this.route.snapshot.paramMap.get('id');
        this.loadArticle();
    }

    loadArticle() {
        if (this.dataService.loaded) {
            this.article = this.dataService.getArticle(this.id);
        } else {
            this.dataService.load().then(() => {
                this.article = this.dataService.getArticle(this.id);
            });
        }
    }
}
