export type UserType = {
  id: number;
  name: string;
  email: string;
  createdAt: string;
  updatedAt: string;
};

export type AuthResponseType = {
  success: boolean;
  data: {
    accessToken: string;
    user: UserType;
  };
  message: string;
};
