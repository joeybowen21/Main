import {Injectable} from '@angular/core';
import {Article} from '../interfaces/article';
import {Storage} from '@ionic/storage';

@Injectable({providedIn: 'root'})
export class NewsDataService {
    public articles: Article[] = [];
    public loaded = false;

    constructor(private storage: Storage) {
    }

    load(): Promise<boolean> {
        return new Promise(resolve => {
            this.storage.get('articles').then(articles => {
                if (articles != null) {
                    this.articles = articles;
                }
                this.loaded = true;
                resolve(true);
            });
        });
    }

    createArticle(data) {
        // tslint:disable-next-line:max-line-length
        this.articles.push({id: this.generateSlug(data.name), title: data.name, description: data.description, extDescription: data.extDescription, url: data.url});
        this.save();
    }

    updateArticle(article, data) {
        const index = this.articles.indexOf(article);
        if (index > -1) {
            this.articles[index].title = data.name;
            this.articles[index].description = data.description;
            this.articles[index].extDescription = data.extDescription;
            this.articles[index].url = data.url;
            this.save();
        }
    }

    deleteArticle(article) {
        const index = this.articles.indexOf(article);
        if (index >= 0) {
            this.articles.splice(index, 1);
            this.save();
        }
    }

    getArticle(id) {
        return this.articles.find(article => article.id === id);
    }

    save() {
        this.storage.set('articles', this.articles);
    }

    generateSlug(title) {
        let slug = title.toLowerCase().replace(/\s+/g, '-');
        const exists = this.articles.filter(article => {
            return article.id.substring(0, slug.length) === slug;
        });
        if (exists.length > 0) {
            slug = slug + exists.length.toString();
        }
        return slug;
    }
}
