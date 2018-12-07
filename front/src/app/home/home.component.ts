import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
  host: {'class': 'mt-auto'}
})
export class HomeComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
