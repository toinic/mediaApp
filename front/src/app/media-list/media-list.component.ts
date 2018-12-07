import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

interface Media{
  id:number;
  type:string;
  title:string;
  author:string;
  cover:string;
}

@Component({
  selector: 'app-media-list',
  templateUrl: './media-list.component.html',
  styleUrls: ['./media-list.component.css']
})
export class MediaListComponent implements OnInit {

  medias:Media[];
  type:number=0;
  search:string='';
  user:string='';

  constructor(private http:HttpClient) {
    this.getMedias();
  }

  ngOnInit() {
  }

  getMedias(){
    let url='http://localhost:8000/media/list?type='+this.type+'&search='+this.search;
    this.http.get(url)
    .subscribe((res:Media[])=>{
      this.medias=res;
      // console.log(res)
    });
  }

  postLoan(mediaId){
    let url='http://localhost:8000/loaning';
    // console.log({'user':this.user, 'mediaId':mediaId})
    this.http.post(url, {'user':this.user, 'mediaId':mediaId})
      .subscribe(res=>{
        console.log(res);
      });
  }

  test(mediaId){
    console.log(mediaId)
  }

}
