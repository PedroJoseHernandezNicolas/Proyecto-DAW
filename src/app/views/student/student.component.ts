import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../services/api/api.service';
import { responseStudentModel } from '../../models/responseStudent.interface';
import { Router } from '@angular/router';
import { studentModel } from '../../models/student.interface';
import { FormControl, FormGroup } from '@angular/forms';


@Component({
  selector: 'app-student',
  templateUrl: './student.component.html',
  styleUrl: './student.component.css'
})
export class StudentComponent implements OnInit {

  dataStudent : studentModel[] = [];


  inputForm = new FormGroup({
    file : new FormControl('')
  })
  

  constructor(
    private api :  ApiService,
    private router : Router,
  ) { }

  ngOnInit() : void {

  }

  returnZero() {
    return 0;
  }

  getStudentByFile(form : any) {
    this.api.getStudentByFile(form.file).subscribe(data => {
      this.dataStudent = data.alumnos;
    }
    );
  }
  
}
