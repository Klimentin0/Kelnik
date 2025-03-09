<template>
  <div id="app">
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/articles/create">New Article</router-link>
    </nav>
    <router-view />
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

nav {
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #eee;
}

nav a {
  color: #2c3e50;
  text-decoration: none;
  margin-right: 1rem;
}

nav a.router-link-exact-active {
  color: #4CAF50;
  font-weight: bold;
}
</style>
