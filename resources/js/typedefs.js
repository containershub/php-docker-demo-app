// Just for testing GraphQL
const typeDefs = /* GraphQL */ `
    schema {
        query: Query
        mutation: Mutation
    }

    type Query {
        books(orderBy: BooksOrderBy = RATING_DESC): [book]
        reviews(): [Review]
    }
`
