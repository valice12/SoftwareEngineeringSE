
    button.addEventListener('click', function() {
    const isActive = this.classList.contains('bg-green-500');
    
      buttons.forEach(btn => {
        btn.classList.remove('bg-green-500', 'text-white');
        btn.classList.add('bg-green-100', 'text-green-800');
      });
      
      if (!isActive) {
        this.classList.remove('bg-green-100', 'text-green-800');
        this.classList.add('bg-green-500', 'text-white');
      }
    });
