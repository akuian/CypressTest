describe('To dashboard', () => {
  it('passes', () => {
    cy.visit('http://localhost:8000/student')
  })
  it('create new student data', () => {
    // We use the `cy.get()` command to get all elements that match the selector.
    // Then, we use `should` to assert that there are two matched items,
    // which are the two default items.
    cy.get('#inputStudent').click()
    cy.get('#Nim')
      .type('2041880220')
    cy.get('#Name')
      .type('Suparman')
    cy.get('#Class').select('TI 2B')
    cy.get('#Major')
      .type('Information Techonlogy')
    cy.get('#Address')
      .type('22 Jump Street')
    cy.get('#date_of_birth').type('1999-12-31')
    cy.get('form').submit()
  })
})
