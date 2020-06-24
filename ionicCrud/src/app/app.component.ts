import {NewsDataService} from './services/news-data.service';
import {Component} from '@angular/core';

@Component({selector: 'app-root', templateUrl: 'app.component.html', styleUrls: ['app.component.scss']})
export class AppComponent {
    constructor(private dataService: NewsDataService) {
        this.dataService.load();
    }
}
