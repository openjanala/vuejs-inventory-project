class AppStorage{

storageToken(token){
    localStorage.setItem('token',token);
}

storageToken(user){
    localStorage.setItem('user',user);
}
    store(token,user){
      this.setItem('token',token);
      this.setItem('user',user)  
    }
    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
 
 getToken(){
    localStorage.getItem('token');
    }  
 },
 getToken(){
    localStorage.getItem('user');
 }
}
export default AppStorage = new AppStorage();