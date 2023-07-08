import { Component, OnInit } from '@angular/core';

import { PersonService } from '../person.service';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormControl, Validators} from '@angular/forms';
import { Person } from '../person';
import { TaskDetail } from '../taskdetail';

@Component({
  selector: 'app-view',
  templateUrl: './view.component.html',
  styleUrls: ['./view.component.css']
})
export class ViewComponent implements OnInit {


  id: number;
  person: Person;
  form: FormGroup;
//   taskdetail: TaskDetail;
  taskdetail: TaskDetail[] = [];

  constructor(
    public personService: PersonService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {

    this.id = this.route.snapshot.params['idPerson'];
    
    this.personService.findDetail(this.id).subscribe((data: Person)=>{
      this.person = data[0];
      console.log(data[0].taskdetails);
      this.taskdetail = data[0].taskdetails;
    });


    // this.personService.findDetail(this.id).subscribe((data: TaskDetail)=>{
    //     this.taskdetail = data[0].taskdetails;
    //     console.log(data[0].taskdetails);
    //   });

    this.form = new FormGroup({
      name:  new FormControl('', [ Validators.required, Validators.pattern('^[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ \-\']+') ]),
      email: new FormControl('', [ Validators.required, Validators.email ]),
      phone: new FormControl('', [ Validators.required, Validators.pattern("^[0-9]*$") ])
    });


  }

  get f(){
    return this.form.controls;
  }

  submit(){
    console.log(this.form.value);
    this.personService.update(this.id, this.form.value).subscribe(res => {
         console.log('Person updated successfully!');
         this.router.navigateByUrl('person/index');
    })
  }

}


