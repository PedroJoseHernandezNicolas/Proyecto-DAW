import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule, routingComponents } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './views/header/header.component';
import { FooterComponent } from './views/footer/footer.component';

import { ReactiveFormsModule, FormsModule } from '@angular/forms'; '@angular/forms'
import { HttpClientModule } from '@angular/common/http';
//NEW# generamos el routingComponents para no importar todos
//import { LoginComponent } from './views/login/login.component';
//import { StudentComponent } from './views/student/student.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    routingComponents
    //LoginComponent,
    //StudentComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
