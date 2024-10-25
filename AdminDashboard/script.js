let Menu = document.querySelector('#Menu')

Menu.addEventListener('click', () => {
  let LeftSidebar = document.querySelector('.LeftSidebar');
  let RightSidebar = document.querySelector('.RightSidebar');
  LeftSidebar.classList.toggle('LeftSideOpen');
  RightSidebar.classList.toggle('RightSideOpen')
})

let UserProfile = document.querySelector('#UserProfile');

UserProfile.addEventListener('click', () => {
  let UserProfileCard = document.querySelector('.UserProfileCard');
  UserProfileCard.classList.toggle('ChangeUserProfileCard')
})
